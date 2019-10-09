<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Talentos;
use App\Entity\Usuario;
use App\Repository\AreaRepository;
use App\Repository\CandidatoRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * @var CandidatoRepository
     */
    private $candidatoRepository;

    /**
     * @var AreaRepository
     */
    private $areaRepository;

    /**
     * SecurityController constructor.
     * @param $usuarioRepository
     * @param $candidatoRepository
     */
    public function __construct(UsuarioRepository $usuarioRepository, CandidatoRepository $candidatoRepository, AreaRepository $areaRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->candidatoRepository = $candidatoRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/login_success", name="login_success")
     */
    public function postLoginRedirectAction()
    {
        $logado = $this->getUser();

        if (!empty($logado->getCandidato())){
            if ($logado->getArea() == null){
                return $this->redirectToRoute('cadastro_area');
            } else
                return $this->redirectToRoute('candidato_home');
        } else if (!empty($logado->getRecrutador())){
            return $this->redirectToRoute('recrutador_home');
        } else if (!empty($logado->getContratador())){
            return $this->redirectToRoute('contratador_home');
        } else if (!empty($logado->getGestor())){
            return $this->redirectToRoute('gestor_home');
        } else {
            return $this->redirectToRoute("home");
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/cadastro", name="cadastro", methods={"GET","POST"})
     */
    public function cadastro(Request $request)
    {
        $candidato = new Candidato();
        $usuario = new Usuario();
        $talentos = new Talentos();

        if (!empty($request->request->get('Cadastrar'))) {

            $talentos->setAnalista(0);
            $talentos->setComunicador(0);
            $talentos->setExecutor(0);
            $talentos->setPlanejador(0);
            $candidato->setTalentos($talentos);
            $candidato->setPontuacao(0);
            $usuario->setNome($request->request->get('nome'));
            $usuario->setSobrenome($request->request->get('sobrenome'));
            $usuario->setDataDeNascimento(new \DateTime($request->request->get('dataDeNascimento')));
            $usuario->setCpf($request->request->get('cpf'));
            $usuario->setTelefone($request->request->get('telefone'));
            $usuario->setEmail($request->request->get('email'));
            $usuario->setPassword($request->request->get('senha'));
            $usuario->setCandidato($candidato);
            $candidato->setUsuario($usuario);

            $this->usuarioRepository->persist($usuario);
            $this->candidatoRepository->persist($candidato);

            return $this->redirectToRoute('login');
        }

        return $this->render('security/cadastro.html.twig', [
            'candidato' => $candidato,
        ]);
    }

    /**
     * @Route("/cadastro/area", name="cadastro_area", methods={"GET","POST"})
     */
    public function cadastroArea(Request $request)
    {
        $areas = $this->areaRepository->findAll();

        /**
         * @var Usuario $logado
         */
        $logado = $this->getUser();

        if (!empty($request->request->get("escolhaArea")))
        {
            $idArea = $request->request->get("area");
            $area = $this->areaRepository->findOneBy(['id' => $idArea]);
            $logado->setArea($area);
            $this->usuarioRepository->save($logado);
            return $this->redirectToRoute('candidato_home');
        }

        return $this->render('security/selecionaArea.html.twig', [
            'areas' => $areas
        ]);
    }
}
