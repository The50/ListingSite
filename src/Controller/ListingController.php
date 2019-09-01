<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Form\ListingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListingRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * @Route("/")
 */
class ListingController extends AbstractController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var ListingRepository
     */
    private $listingRepository;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param Environment $twig
     * @param ListingRepository $listingRepository
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        ListingRepository $listingRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->listingRepository = $listingRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    /**
     * @Route("/", name="listing_index")
     */
    public function index()
    {
        $html = $this->twig->render(
            'listing/index.html.twig',
            [
                'lists' => $this->listingRepository->findBy(
                    [],
                    ['time' => 'DESC']
                ),
                'usersToFollow' => 'test',
            ]
        );

        return new Response($html);
    }

    /**
     * @Route("/add", name="listing_add")
     * @param Request $request
     * @param TokenStorageInterface $tokenStorage
     * @return RedirectResponse|Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function add(Request $request, TokenStorageInterface $tokenStorage)
    {
        $user = $tokenStorage->getToken()
            ->getUser();

        $listing = new Listing();
        $listing->setTime(new \DateTime());
        $listing->setUser($user);

        $form = $this->formFactory->create(
            ListingType::class,
            $listing
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($listing);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('listing_index')
            );
        }

        $html = $this->twig->render(
            'listing/add.html.twig',
            ['form' => $form->createView()]
        );

        return new Response($html);
    }

    /**
     * @Route("/listing/{id}", name="listing_inner")
     */
    public function innerListing($id)
    {
        $listing = $this->listingRepository->find($id);

        $html = $this->twig->render(
            'listing/listing.html.twig',
            ['listing' => $listing]
        );

        return new Response($html);
    }

    /**
     * @Route("/edit/{id}", name="listing_edit")
     * @param $id
     * @param Request $request
     * @param TokenStorageInterface $tokenStorage
     * @return RedirectResponse|Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function editListing($id, Request $request, TokenStorageInterface $tokenStorage)
    {
        $listing = $this->listingRepository->find($id);
        $listing->setTime(new \DateTime());

        $user = $tokenStorage->getToken()
            ->getUser();

        $form = $this->formFactory->create(
            ListingType::class,
            $listing
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('listing_index')
            );
        }

        if ($listing->getUser()->getId() === $user->getId() || in_array('ROLE_ADMIN', $user->getRoles())) {
            $html = $this->twig->render(
                'listing/add.html.twig',
                ['form' => $form->createView()]
            );

            return new Response($html);
        } else {
            return new RedirectResponse(
                $this->router->generate('listing_index')
            );
        }
    }

    /**
     * @Route("/delete/{id}", name="listing_delete")
     * @param $id
     * @param TokenStorageInterface $tokenStorage
     * @return RedirectResponse
     */
    public function deleteListing($id, TokenStorageInterface $tokenStorage)
    {
        $listing = $this->listingRepository->find($id);

        $user = $tokenStorage->getToken()
            ->getUser();

        if ($listing->getUser()->getId() === $user->getId() || in_array('ROLE_ADMIN', $user->getRoles())) {
            $this->entityManager->remove($listing);
            $this->entityManager->flush();
        }

        return new RedirectResponse(
            $this->router->generate('listing_index')
        );
    }

    /**
     * @Route("/my-listings", name="listings_user")
     * @param TokenStorageInterface $tokenStorage
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function userPosts(TokenStorageInterface $tokenStorage)
    {
        $user = $tokenStorage->getToken()
            ->getUser();

        $html = $this->twig->render(
            'listing/user-posts.html.twig',
            [
                'lists' => $this->listingRepository->findBy(
                    ['user' => $user],
                    ['time' => 'DESC']
                ),
                'user' => $user,
            ]
        );

        return new Response($html);
    }
}
