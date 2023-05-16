<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationType
 *
 * @ORM\Table(name="notification_type")
 * @ORM\Entity
 */
class NotificationType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idnotification_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnotificationType;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_type_name", type="string", length=100, nullable=false)
     */
    private $notificationTypeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notification_type_description", type="string", length=250, nullable=true)
     */
    private $notificationTypeDescription;

    public function getIdnotificationType(): ?int
    {
        return $this->idnotificationType;
    }

    public function getNotificationTypeName(): ?string
    {
        return $this->notificationTypeName;
    }

    public function setNotificationTypeName(string $notificationTypeName): self
    {
        $this->notificationTypeName = $notificationTypeName;

        return $this;
    }

    public function getNotificationTypeDescription(): ?string
    {
        return $this->notificationTypeDescription;
    }

    public function setNotificationTypeDescription(?string $notificationTypeDescription): self
    {
        $this->notificationTypeDescription = $notificationTypeDescription;

        return $this;
    }


}
