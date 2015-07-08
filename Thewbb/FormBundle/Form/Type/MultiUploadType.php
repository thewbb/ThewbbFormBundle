<?php
/**
 * Created by PhpStorm.
 * User: thewbb
 * Date: 2015/7/5
 * Time: 14:18
 */

namespace Thewbb\FormBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultiUploadType extends HiddenType {
    protected $router;

    public function  __construct($router){
        $this->router = $router;
    }
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('upload_url'));

        $resolver->setDefaults(array(
            'compound' => false,
            'upload_url' => $this->router->generate("thewbb_form_multi_upload"),
            'images' => array(),
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['upload_url'] = $options['upload_url'];
        $view->vars['images'] = json_decode($view->vars['value']);
    }

    public function getParent()
    {
        return 'hidden';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'multi_upload';
    }

} 