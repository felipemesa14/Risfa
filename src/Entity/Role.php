<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo_role_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codigoRolePk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, unique=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="roleRel")
     */
    protected $usuariosRoleRel;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuariosRoleRel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get codigoRolePk
     *
     * @return integer
     */
    public function getCodigoRolePk()
    {
        return $this->codigoRolePk;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Role
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add usuariosRoleRel
     *
     * @param \App\Entity\User $usuariosRoleRel
     *
     * @return Role
     */
    public function addUsuariosRoleRel(\App\Entity\User $usuariosRoleRel)
    {
        $this->usuariosRoleRel[] = $usuariosRoleRel;

        return $this;
    }

    /**
     * Remove usuariosRoleRel
     *
     * @param \App\Entity\User $usuariosRoleRel
     */
    public function removeUsuariosRoleRel(\App\Entity\User $usuariosRoleRel)
    {
        $this->usuariosRoleRel->removeElement($usuariosRoleRel);
    }

    /**
     * Get usuariosRoleRel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosRoleRel()
    {
        return $this->usuariosRoleRel;
    }
}
