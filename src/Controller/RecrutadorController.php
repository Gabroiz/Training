<?php

namespace App\Controller;

use App\Entity\Area;
use App\Repository\AreaRepository;
use App\Repository\CandidatoRepository;
use App\Repository\GestorRepository;
use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recrutador")
 */
class RecrutadorController extends AbstractController
{
    /**
     * @var AreaRepository
     */
    private $areaRepository;

    /**
     * @var CandidatoRepository
     */
    private $candidatoRepository;

    /**
     * @var GestorRepository
     */
    private $gestorRepository;

    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * RecrutadorController constructor.
     * @param AreaRepository $areaRepository
     * @param CandidatoRepository $candidatoRepository
     * @param GestorRepository $gestorRepository
     */
    public function __construct(AreaRepository $areaRepository, CandidatoRepository $candidatoRepository, GestorRepository $gestorRepository, UsuarioRepository $usuarioRepository)
    {
        $this->areaRepository = $areaRepository;
        $this->candidatoRepository = $candidatoRepository;
        $this->gestorRepository = $gestorRepository;
        $this->usuarioRepository = $usuarioRepository;
    }


    /**
     * @Route("/", name="recrutador_home")
     */
    public function index()
    {
        return $this->render('recrutador/index.html.twig', [
            'controller_name' => 'RecrutadorController',
        ]);
    }

    /**
     * @Route("/meuPerfil", name="recrutador_perfil")
     */
    public function meuPerfil()
    {
        return $this->render('recrutador/meuPerfil.html.twig', [
            'controller_name' => 'RecrutadorController',
        ]);
    }

    /**
     * @Route("/meuPerfil/", name="recrutador_editPerfil")
     */
    public function editMeuPerfil()
    {
        return $this->render('recrutador/index.html.twig', [
            'controller_name' => 'RecrutadorController',
        ]);
    }

    /**
     * @Route("/areas", name="recrutador_areas")
     */
    public function areas()
    {
        $areas = $this->areaRepository->findAll();

        return $this->render('recrutador/areas.html.twig', [
            'areas' => $areas
        ]);
    }

    /**
     * @Route("/areas/new", name="recrutador_areaNew", methods={"POST","GET"})
     */
    public function newArea(Request $request)
    {
        $area = new Area();

        if(!empty($request->request->get('cadastrar'))){
            $area->setNome($request->request->get('nomeArea'));
            $area->setIcone($request->request->get('iconeArea'));

            $this->areaRepository->persist($area);

            return $this->redirectToRoute('recrutador_areas');
        }

        return $this->render('recrutador/newArea.html.twig');
    }

    /**
     * @Route("/gestores", name="recrutador_gestores")
     */
    public function gestores()
    {
        return $this->render('recrutador/gestores.html.twig', [
            'controller_name' => 'RecrutadorController',
        ]);
    }

    /**
     * @Route("/ranking", name="recrutador_ranking")
     */
    public function ranking(Request $request)
    {
        $areas = $this->areaRepository->findAll();

        if(!empty($request->request->get('pesquisar')))
        {
            $area = $request->request->get('area');
            $candidatos = $this->candidatoRepository->findAll();
            $usuarios = new ArrayCollection();

            foreach ($candidatos as $candidato)
            {
                $usuarioId = $candidato->getUsuario();
                $usuarios->add($this->usuarioRepository->findOneBy(['id' => $usuarioId, 'area' => $area]));
            }
        }

        $candidatos = $this->candidatoRepository->findAll();
        $usuarios = new ArrayCollection();

        if(!empty($request->request->get('pesquisar')) && $request->request->get('pesquisar') != null) {
            $area = $request->request->get('area');
            foreach ($candidatos as $candidato)
            {
                $usuarioId = $candidato->getUsuario();
                $usuarios->add($this->usuarioRepository->findOneBy(['id' => $usuarioId, 'area' => $area]));
            }
        } else {
            foreach ($candidatos as $candidato) {
                $usuarioId = $candidato->getUsuario();
                $usuarios->add($this->usuarioRepository->findOneBy(['id' => $usuarioId]));
            }
        }

        return $this->render('recrutador/ranking.html.twig', [
            'usuarios' => $usuarios,
            'areas' => $areas
        ]);
    }

    /**
     * @Route("/avisos", name="recrutador_avisos")
     */
    public function avisos()
    {
        return $this->render('recrutador/avisos.html.twig', [
            'controller_name' => 'RecrutadorController',
        ]);
    }
}