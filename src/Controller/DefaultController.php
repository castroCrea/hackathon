<?php
/**
 * Created by PhpStorm.
 * User: birdoffice
 * Date: 08/11/18
 * Time: 17:00
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function index() {
        return $this->render('index.html.twig');

    }
}