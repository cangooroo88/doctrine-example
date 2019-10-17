<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class GroupOfEntities
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
     * @var Entity
     *
     * @ORM\OneToOne(targetEntity="Entity", inversedBy="groupEntityAsParent")
     * @ORM\JoinColumn(name="grouped_entity_id", referencedColumnName="id")
     */
    protected $parentEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="groupEntityAsChild")
     */
    protected $childEntities;

    public function __construct()
    {
        $this->childEntities = new ArrayCollection();
    }

    /**
     * @return Entity
     */
    public function getParentGroupedEntity(): Entity
    {
        return $this->parentEntity;
    }

    /**
     * @param Entity $parentEntity
     */
    public function setParentGroupedEntity(Entity $parentEntity): void
    {
        $this->parentEntity = $parentEntity;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildEntities()
    {
        return $this->childEntities;
    }

    public function addChildEntity(Entity $childEntity)
    {
        if (!$this->childEntities->contains($childEntity)) {
            $this->childEntities->add($childEntity);
            $childEntity->setGroupAsChild($this);
        }

        return $this;
    }

    public function removeChildEntity(Entity $childEntity)
    {
        if ($this->childEntities->contains($childEntity)) {
            $this->childEntities->removeElement($childEntity);
        }

        return $this;
    }
}