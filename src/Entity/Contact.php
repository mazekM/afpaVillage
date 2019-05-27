<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;


    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="#^0[1-68]([-. ]?[0-9]{2}){4}$#"
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=200)
     */
    private $message;
    
    /**
     * @var Evenements|null
     */
    private $evenement;

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    
    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    

    /**
     * Get the value of evenement
     *
     * @return  Evenements|null
     */ 
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set the value of evenement
     *
     * @param  Evenements|null  $evenement
     *
     * @return  self
     */ 
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }
}
