<?php
/**
 * Created by PhpStorm.
 * User: Alexander Wegner
 * Date: 06.12.2018
 * Time: 11:15
 */

namespace Oforge\Engine\Modules\Auth\Models\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Oforge\Engine\Modules\Core\Abstracts\AbstractModel;

/**
 * @ORM\Table(name="oforge_auth_backend_user")
 * @ORM\Entity
 */
class BackendUser extends AbstractModel
{

    const ROLE_SYSTEM = 0;
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_MODERATOR = 2;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="email", type="string", nullable=false, unique=true)
     */
    private $email;
    
    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;
    
    /**
     * 0 = admin, 1 = moderator, 2 = other
     *
     * @var int
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    private $role;
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    
    /**
     * @return int
     */
    public function getRole(): int {
        return $this->role;
    }
    
    /**
     * @param $role int
     */
    public function setRole($role) {
        $this->role = $role;
    }
}