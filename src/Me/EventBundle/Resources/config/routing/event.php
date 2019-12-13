<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('event_index', new Route(
    '/',
    array('_controller' => 'EventBundle:Event:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('event_show', new Route(
    '/{id}/show',
    array('_controller' => 'EventBundle:Event:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('event_new', new Route(
    '/new',
    array('_controller' => 'EventBundle:Event:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('event_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'EventBundle:Event:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('event_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'EventBundle:Event:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
