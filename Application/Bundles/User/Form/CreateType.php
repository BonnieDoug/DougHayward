<?php

namespace User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
/**
 * Description of CreateType
 *
 * @author dhayward
 */
class CreateType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username')
            ->add('password')
            ->add('email')
            ->add('save', 'submit')
        ;
    }
    public function getName() {
        return 'user_create';
    }
}