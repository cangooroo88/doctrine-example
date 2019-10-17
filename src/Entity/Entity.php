<?php

namespace App\Entity;

/**
 * Class Entity
 * @package App\Entity
 */
class Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @var GroupOfEntities
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupOfEntities", inversedBy="childOwnerEntity")
     * @ORM\JoinColumn(name="grouped_entity_as_child_id", referencedColumnName="id")
     */
    private $groupOfEntitiesAsChild;

    /**
     * @var GroupOfEntities
     * @ORM\OneToOne(targetEntity="App\Entity\GroupOfEntities", mappedBy="parentOwnerEntity")
     */
    private $groupOfEntitiesAsParent;

    /**
     * @return GroupOfEntities|null
     */
    public function getGroupAsChild()
    {
        return $this->groupOfEntitiesAsChild;
    }

    /**
     * @param GroupOfEntities $group
     */
    public function setGroupAsChild(GroupOfEntities $group): void
    {
        $this->groupOfEntitiesAsChild = $group;
    }

    /**
     * @return GroupOfEntities|null
     */
    public function getEntityGroupAsParent()
    {
        return $this->groupOfEntitiesAsParent;
    }

    /**
     * @param GroupOfEntities $group
     */
    public function setGroupAsParent(GroupOfEntities $group): void
    {
        $this->groupOfEntitiesAsParent = $group;
    }
}