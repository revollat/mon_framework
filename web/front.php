<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TranslationServiceProvider;

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

// Instantiation d'une nouvelle application Silex !! :)
$app = new Silex\Application();

// On afiche les erreurs (car on est en train de développer le site)
$app['debug'] = true;

$app->register(new Silex\Provider\SessionServiceProvider());

// On initialise TWIG en lui indiquant le dossier ou se trouve les templates.
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
));

// service pour créer les formulaires
$app->register(new FormServiceProvider());

// service de validation de formulaire
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider(array(
    'translator.domains' => array(),
)));

// service d'envoi de mail
$app->register(new Silex\Provider\SwiftmailerServiceProvider());
$app['swiftmailer.options'] = array(
    'host' => 'localhost',
    'port' => '25'
);

// mysql -u root -pmdp4root < /var/www/mf.local.dev/portfolio_modele.sql
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'dbhost' => 'localhost',
        'dbname' => 'portfolio_modele',
        'user' => 'root',
        'password' => 'mdp4root',
    ),
));

// ACCUEIL
$app->get('/', function () use ($app) {
    return $app['twig']->render('pages/accueil.html.twig');
});

// Page CV
$app->get('/cv', function () use ($app) {
    return $app['twig']->render('pages/cv.html.twig');
});

// page réalisation
$app->get('/realisations', function () use ($app) {
    $realisations = $app['db']->fetchAll('SELECT * FROM realisations');
    return $app['twig']->render('pages/realisations.html.twig', array('realisations' => $realisations));
});


// Page formulaire contact
$app->match('/contact', function (Request $request) use ($app) {

    $form = $app['form.factory']->createBuilder()
        ->add('email', 'email', array(
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Email()
            ),
        ))
        ->add('sujet', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
        ))
        ->add('message', 'textarea', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
        ))
        ->getForm();

    if ($request->isMethod('POST')) {
        $form->bind($request);

        if ($form->isValid()) {

//            sudo service exim4 stop
//            sudo python -m smtpd -n -c DebuggingServer localhost:25

            $message = \Swift_Message::newInstance()
                ->setSubject($form->get('sujet')->getData())
                ->setFrom($form->get('email')->getData())
                ->setTo('test@example.com')
                ->setBody(
                    $app['twig']->render(
                        'mail/email_contact.txt.twig',
                        array('message' => $form->get('message')->getData())
                    )
                );
            $app['mailer']->send($message);

            $app['session']->getFlashBag()->add('message', 'Votre message à bien été envoyé !!');

            return $app->redirect('/');
        }
    }

    return $app['twig']->render('pages/contact.html.twig', array('form' => $form->createView()));
});

// Erreur
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    $page = 404 == $code ? '404.twig' : '500.twig';
    return new Response($app['twig']->render('erreurs/'.$page, array('code' => $code)), $code);
});

$app->run();