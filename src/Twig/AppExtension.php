<?php
namespace App\Twig;

use Symfony\Component\Validator\Constraints\Date;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('promoActive', [$this, 'checkIfPromo']),
        ];
    }

    public function checkIfPromo(\DateTime $promoFrom, \DateTime $promoTill)
    {
        $time = new \DateTime();

        if ($time >= $promoFrom && $time < $promoTill) {
            return true;
        } else {
            return false;
        }
    }
}
