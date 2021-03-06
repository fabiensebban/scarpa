<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array(
    'zfcuser' => array(
        'new_user_default_role' => 'member',
    ),
    
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'index',
                    ),
                ),
            ),
            'articles - index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/articles/index',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'index',
                    ),
                ),
            ),
            'commentaire - desactiver' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/commentaire/desactiver/[:articleID]/[:commentaireID]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Commentaires',
                        'action'     => 'desactiver',
                    ),
                    'constraints' => array(
                        'articleID'     => '[0-9]+',
                        'commentaireID' => '[0-9]+',
                    ),
                ),
            ),
            'commentaire - activer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/commentaire/activer/[:articleID]/[:commentaireID]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Commentaires',
                        'action'     => 'activer',
                    ),
                    'constraints' => array(
                        'articleID'     => '[0-9]+',
                        'commentaireID' => '[0-9]+',
                    ),
                ),
            ),
            'articles - desactiver' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/articles/desactiver/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'desactiver',
                    ),
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                ),
            ),
            'articles - activer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/articles/activer/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'activer',
                    ),
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                ),
            ),
            'articles - view' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/articles/view/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'view',
                    ),
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                ),
            ),
            'articles - create' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/articles/create',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'create',
                    ),
                ),
            ),
            'articles - createCommentaire' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/articles/createCommentaire',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'createCommentaire',
                    ),
                ),
            ),
            'articles - contact' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/articles/contact',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Articles',
                        'action'     => 'contact',
                    ),
                ),
            ),
            'categories - create' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/categories/create',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Categories',
                        'action'     => 'create',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Application\Service\Article' => 'Application\Service\Factory\ArticleFactory',
            'Application\Service\Auteur' => 'Application\Service\Factory\AuteurFactory',
            'Application\Service\Categorie' => 'Application\Service\Factory\CategorieFactory',
            'Application\Service\Commentaire' => 'Application\Service\Factory\CommentaireFactory'            
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',          
            'Application\Controller\Articles' => 'Application\Controller\ArticlesController',
            'Application\Controller\Categories' => 'Application\Controller\CategoriesController',
            'Application\Controller\Commentaires' => 'Application\Controller\CommentairesController'
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'                     => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'           => __DIR__ . '/../view/application/index/index.phtml',
            'application/articles/detail'       => __DIR__ . '/../view/application/articles/detail.phtml',
            'application/articles/categorie'    => __DIR__ . '/../view/application/articles/categorie.phtml',
            'application/articles/auteur'       => __DIR__ . '/../view/application/articles/auteur.phtml',
            'application/articles/index'        => __DIR__ . '/../view/application/articles/index.phtml',
            'error/404'                         => __DIR__ . '/../view/error/404.phtml',
            'error/index'                       => __DIR__ . '/../view/error/index.phtml',
            'zfc-user/user/login'               => __DIR__ . '/../view/application/zfc-user/user/login.phtml',
            'zfc-user/user/register'            => __DIR__ . '/../view/application/zfc-user/user/register.phtml',
            'zfc-user/user/index'               => __DIR__ . '/../view/application/zfc-user/user/index.phtml',
            'zfc-user/user/change'               => __DIR__ . '/../view/application/zfc-user/user/index.phtml',
            
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
            'zfc-user' => __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);
