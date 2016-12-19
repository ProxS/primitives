<?php

namespace Primitives;

interface FigureProperty 
{
    public function setColor($color);
    
    public function getColor();
    
    public function setStartPoint(array $point);
    
    public function getStartPoint();
}

trait Radius
{
    public function setRadius($radius) {
	$this->radius = $radius;
    }
    
    public function getRadius() {
	return $this->radius;
    } 
}

trait Angles
{
    public function getAngles() {
	return [$this->angleBegA, $this->angleEndA];
    }
    
    public function setAngles(array $angles) {
	list($this->angleBegA, $this->angleEndA) = $angles;
    }
}

abstract class Figure implements FigureProperty
{
    private $x;
    private $y;
    private $color = 'black';
    
    public function __construct(array $point) {
	list($this->x, $this->y) = $point;
    }
    
    public function setColor($color = 'black') {
	$this->color = $color;
    }

    public function getColor() {
	return $this->color;
    }
    
    public function setStartPoint(array $point) {
	list($this->x, $this->y) = $point;
    }
    
    public function getStartPoint() {
	return [$this->x,  $this->y];
    }    
}

class Point extends Figure
{
    
}

class Line extends Figure
{
    private $x2;
    private $y2;
    
    public function __construct(array $point, array $point2) {
	parent::__construct($point);
	list($this->x2, $this->y2) = $point2;
    }
    
    public function setEndpoint(array $point) {
	list($this->x2, $this->y2) = $point;
    }
}

class Circle extends Figure
{   
    use Radius;
    private $radius;

    public function __construct(array $point, $radius) {
	parent::__construct($point);
	$this->radius = $radius;
    }
    
    
}

class Arch extends Figure
{   
    use Radius, Angles;
    private $radius;
    private $angleBegA;
    private $angleEndA;
    
    public function __construct(array $point, array $angles, $radius) {
	parent::__construct($point);
	list($this->angleBegA, $this->angleEndA) = $angles;
	$this->radius = $radius;
    }
}

//Testing
/*
$arch = new Arch([0,0], [0,45], 10);
var_dump($arch);
echo '<br>';

$arch->setStartPoint([-2,4]);
$arch->setColor('blue');
$arch->setRadius(6);
$arch->setAngles([30, 90]);

print_r($arch->getStartPoint());
echo '<br>';
print_r($arch->getColor());
echo '<br>';
print_r($arch->getRadius());
echo '<br>';
print_r($arch->getAngles());
echo '<br>';
var_dump($arch);
 * 
 */