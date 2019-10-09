<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Feedback;
use App\Entity\Resposta;
use App\Repository\CasoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestor")
 */
class GestorController extends AbstractController
{
    private $casoRepository;

    /**
     * GestorController constructor.
     * @param $casoRepository
     */
    public function __construct(CasoRepository $casoRepository)
    {
        $this->casoRepository = $casoRepository;
    }

    /**
     * @Route("/", name="gestor_home")
     */
    public function index()
    {
        return $this->render('gestor/index.html.twig');
    }

    /**
     * @Route("/meuPerfil", name="gestor_meuPerfil")
     */
    public function meuPerfil()
    {
        return $this->render('gestor/meuPerfil.html.twig');
    }

    /**
     * @Route("/meuPerfil/edit", name="gestor_meuPerfil_edit")
     */
    public function editMeuPerfil()
    {
        return $this->render('gestor/editMeuPerfil.html.twig');
    }

    /**
     * @Route("/casos", name="gestor_casos")
     */
    public function casos()
    {
        $casos = $this->casoRepository->findAll();

        return $this->render('gestor/cases.html.twig', [
            'casos' => $casos
        ]);
    }

    /**
     * @Route("/casos/new", name="gestor_newCaso")
     */
    public function newCasos(Request $request)
    {
        $caso = new Caso();

        if(!empty($request->request->get('criarCase'))){
            $caso->setTitulo($request->request->get('titulo'));
            $caso->setDescricao($request->request->get('descricao'));
            $caso->setVideos($request->request->get('linkVideo'));
            $caso->setPergunta($request->request->get('pergunta'));
            $caso->addResposta(new Resposta($request->request->get('resp_a'),$request->request->get('a_pontos'),$caso));
            $caso->addResposta(new Resposta($request->request->get('resp_b'),$request->request->get('b_pontos'),$caso));
            $caso->addResposta(new Resposta($request->request->get('resp_c'),$request->request->get('c_pontos'),$caso));
            $caso->addResposta(new Resposta($request->request->get('resp_d'),$request->request->get('d_pontos'),$caso));
            $caso->addResposta(new Resposta($request->request->get('resp_e'),$request->request->get('e_pontos'),$caso));
            $caso->setFeedback(new Feedback($request->request->get('feedback')));
            $caso->setArea($this->getUser()->getArea());
            $caso->setDataDeCriacao(new \DateTime('now'));

            $this->casoRepository->persist($caso);
            return $this->redirectToRoute('gestor_casos');
        }

        return $this->render('gestor/newCase.html.twig');
    }

    /**
     * @Route("/casos/delete/{id}", name="gestor_deleteCaso")
     */
    public function deleteCasos(Request $request, Caso $caso)
    {
        if(!empty($request->request->get('excluirCase'))){
            $this->casoRepository->remove($caso);
        }

        return $this->redirectToRoute('gestor_casos');
    }
}
