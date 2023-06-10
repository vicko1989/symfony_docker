<?php

namespace App\Controller;

use App\Entity\Nekretnina;
use App\Form\NekretninaType;
use App\Repository\NekretninaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/nekretnina')]
class NekretninaController extends AbstractController
{
    #[Route('/', name: 'app_nekretnina_index', methods: ['GET'])]
    public function index(NekretninaRepository $nekretninaRepository): Response
    {
        return $this->render('nekretnina/index.html.twig', [
            'nekretninas' => $nekretninaRepository->findAll(),
        ]);
    }

    #[Route('/front', name: 'app_nekretnina_front', methods: ['GET', 'POST'])]
    public function front(Request $request, NekretninaRepository $nekretninaRepository): Response
    {
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $data = $nekretninaRepository->findAll();
            return $this->json($data);
        } else {
            return $this->render('nekretnina/front.html.twig');
        }
    }

    #[Route('/new', name: 'app_nekretnina_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NekretninaRepository $nekretninaRepository, SluggerInterface $slugger): Response
    {
        $nekretnina = new Nekretnina();
        $form = $this->createForm(NekretninaType::class, $nekretnina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'filename' property to store the image file name
                // instead of its contents
                $nekretnina->setFilename($newFilename);
            }

            $nekretninaRepository->save($nekretnina, true);

            return $this->redirectToRoute('app_nekretnina_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nekretnina/new.html.twig', [
            'nekretnina' => $nekretnina,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nekretnina_show', methods: ['GET'])]
    public function show(Nekretnina $nekretnina): Response
    {
        return $this->render('nekretnina/show.html.twig', [
            'nekretnina' => $nekretnina,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nekretnina_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nekretnina $nekretnina, NekretninaRepository $nekretninaRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(NekretninaType::class, $nekretnina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'filename' property to store the image file name
                // instead of its contents
                $nekretnina->setFilename($newFilename);
            }

            $nekretninaRepository->save($nekretnina, true);

            return $this->redirectToRoute('app_nekretnina_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nekretnina/edit.html.twig', [
            'nekretnina' => $nekretnina,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nekretnina_delete', methods: ['POST'])]
    public function delete(Request $request, Nekretnina $nekretnina, NekretninaRepository $nekretninaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nekretnina->getId(), $request->request->get('_token'))) {
            $nekretninaRepository->remove($nekretnina, true);
        }

        return $this->redirectToRoute('app_nekretnina_index', [], Response::HTTP_SEE_OTHER);
    }
}
