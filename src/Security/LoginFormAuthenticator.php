<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Security;

use App\Domain\Models\User;
use App\UI\Forms\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var RouterInterface */
    private $router;
    /** @var FormFactoryInterface */
    private $formFactory;
    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;
    /** @var SessionInterface */
    private $session;

    /**
     * LoginFormAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $passwordEncoder,
        SessionInterface $session
    ) {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'login'
            && $request->isMethod('POST');
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return array(
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      );
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return array('api_key' => $request->headers->get('X-API-TOKEN'));
     *
     * @param Request $request
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     */
    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(LoginType::class)->handleRequest($request);
        $dto = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $dto->email
        );
        return $dto;
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return null|object
     * @throws AuthenticationException
     *
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials->email]);
        if (!$user) {
            throw new CustomUserMessageAuthenticationException("Identifiants invalides !");
        }
        return $user;
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $isValidPwd = $this->passwordEncoder->isPasswordValid($user, $credentials->password);
        if (!$isValidPwd) {
            throw new CustomUserMessageAuthenticationException("Identifiants invalides !");
        }
        return true;
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $this->session->getFlashBag()->add("success", "Connexion réussie !");
        return new RedirectResponse($this->router->generate('homepage'));
    }

    /**
     * Return the URL to the login page.
     *
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
}
