<?php
namespace App\Form;

use App\Dto\ContactDto;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('email', EmailType::class)
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Support Technique' => 'support@exemple.com',
                    'Marketing' => 'marketing@exemple.com',
                    'Comptabilite' => 'comptabilite@exemple.com',
                ],
                'placeholder' => 'Sélectionnez un service',
            ])
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactDto::class,
        ]);
    }
}