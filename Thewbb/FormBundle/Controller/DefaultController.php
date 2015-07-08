<?php

namespace Thewbb\FormBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Thewbb\FormBundle\Entity\Image;
use Thewbb\FormBundle\Entity\Store;
use Thewbb\FormBundle\Form\Type\ImageType;
use Thewbb\FormBundle\Form\Type\ProductType;
use Thewbb\FormBundle\Form\Type\StoreType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ImageType());

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();
            return new Response("添加成功");
        }


        return $this->render('ThewbbFormBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

    public function addStoreAction(Request $request){
        
    }

    public function multiUploadAction(Request $request){
        $img = $request->get('img');
        $id = $request->get('id');

        if(isset($img)){
            $uploadUrl = $this->generateUrl('thewbb_form_multi_upload')."?id=$id";
            return $this->render('ThewbbFormBundle:Default:upload_response.html.twig', array(
                'img' => $img,
                'id' => $id,
                'upload_url' => $uploadUrl,

            ));
        }
        else{
            $access_id = 'your access id';
            $access_key = 'your access key';
            $policy = '{"expiration": "2120-01-01T12:00:00.000Z","conditions":[{"bucket": "xiaoqu21" },["content-length-range", 0, 104857600]]}';
            $policy = base64_encode($policy);
            $signature = base64_encode(hash_hmac('sha1', $policy, $access_key, true));
            $file_name = date('Y') . '/' . date('m') . '/' . md5(microtime(true)) . '.jpg';
            $url = "http://".$_SERVER['HTTP_HOST'].$this->generateUrl('thewbb_form_multi_upload');

            return $this->render('ThewbbFormBundle:Default:upload.html.twig', array(
                'access_id' => $access_id,
                'policy' => $policy,
                'signature' => $signature,
                'file_name' => $file_name,
                'url' => $url,
                'id' => $id,
            ));
        }

}
}
