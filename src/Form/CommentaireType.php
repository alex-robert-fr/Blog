<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment')
            ->add('name')
            ->add('email')
            ->add('createdAt', DateType::class, ['input' => 'datetime_immutable'] )
            ->add('article')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
