<?php

// recibe la clase y los atributos

function create($class, $attr = []){

    return $class::factory()->create($attr);
}