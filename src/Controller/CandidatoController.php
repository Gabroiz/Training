<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Caso;
use App\Entity\Usuario;
use App\Repository\AreaRepository;
use App\Repository\CandidatoRepository;
use App\Repository\CasoRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/candidato")
 */
class CandidatoController extends AbstractController
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
     * @var CasoRepository
     */
    private $casoRepository;

    public function __construct(UsuarioRepository $usuarioRepository, CandidatoRepository $candidatoRepository, AreaRepository $areaRepository, CasoRepository $casoRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->candidatoRepository = $candidatoRepository;
        $this->areaRepository = $areaRepository;
        $this->casoRepository = $casoRepository;
    }

    /**
     * @Route("/", name="candidato_home")
     */
    public function index()
    {
        return $this->render('candidato/index.html.twig');
    }

    /**
     * @Route("/cases", name="candidato_cases")
     */
    public function cases()
    {
        /**
         * @var Usuario $logado
         */
        $logado = $this->getUser();
        $casos = $this->casoRepository->findBy(['area' => $logado->getArea()]);

        return $this->render('candidato/casos.html.twig', [
            'area' => $logado->getArea(),
            'casos' => $casos
        ]);
    }

    /**
     * @Route("/cases/{id}", name="candidato_caseAcessa")
     */
    public function acessarCase(Request $request, Caso $caso)
    {
        return $this->render('candidato/case.html.twig', [
            'caso' => $caso
        ]);
    }

    /**
     * @Route("/cases/{id}/resolve", name="candidato_caseResolve")
     */
    public function resolverCase(Request $request, Caso $caso)
    {
        $a = $this->getUser();

        if(!empty($request->request->get('enviar')))
        {
            $a;
        }

        return $this->render('candidato/index.html.twig');
    }

    /**
     * @Route("/meuPerfil", name="candidato_perfil")
     */
    public function meuPerfil()
    {
        return $this->render('candidato/meuPerfil.html.twig', [
            'controller_name' => 'CandidatoController',
        ]);
    }

    /**
     * @Route("/meuPerfil/edit", name="candidato_editPerfil")
     */
    public function editMeuPerfil(Request $request)
    {

        return $this->render('candidato/editMeuPerfil.html.twig', [
            'controller_name' => 'CandidatoController',
        ]);
    }

    /**
     * @Route("/talentos", name="candidato_talentos")
     */
    public function talentos()
    {
        return $this->render('candidato/talentos.html.twig', [
            'controller_name' => 'CandidatoController',
        ]);
    }

    /**
     * @Route("/avisos", name="candidato_avisos")
     */
    public function avisos()
    {


        return $this->render('candidato/avisos.html.twig', [

        ]);
    }
}
