<?php

namespace App\Form;

use App\Entity\Entity;
use App\Repository\GroupedEntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentEntity', EntityType::class, [
                'label' => 'Родительская сущность',
                'class' => Entity::class,
                'required' => true,
                'placeholder' => 'Выберите родительский магнит',
                'query_builder' => function (GroupedEntityRepository $mr) {
                    return $mr->getAllNonGroupedQb();
                }
            ])
            ->add('childEntities', EntityType::class, [
                'label' => 'Дочерние сущности',
                'class' => Entity::class,
                'required' => true,
                'multiple' => true,
                'placeholder' => 'Выберите дочерние магниты',
                'query_builder' => function (GroupedEntityRepository $mr) {
                    return $mr->getAllNonGroupedQb();
                }
            ])
        ;
    }
}