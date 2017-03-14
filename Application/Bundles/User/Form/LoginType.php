<?php

namespace User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
/**
 * Description of LoginType
 *
 * @author dhayward
 */
class LoginType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username')
            ->add('password')
            ->add('save', 'submit')
        ;
    }
    public function getName() {
        return 'user_login';
    }
}