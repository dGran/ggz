<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use App\Entity\UserGGZ;
use Doctrine\ORM\Mapping as ORM;

/**
 * Notifications
 *
 * @ORM\Table(name="notifications", indexes={@ORM\Index(name="fk_notifications_user_id_idx", columns={"notifications_user_id"}), @ORM\Index(name="fk_notifications_notification_type_idx", columns={"notifications_notification_type"})})
 * @ORM\Entity
 */
class Notifications
{
    /**
     * @var int
     *
     * @ORM\Column(name="idnotifications", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnotifications;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notifications_link", type="string", length=255, nullable=true)
     */
    private $notificationsLink;

    /**
     * @var bool
     *
     * @ORM\Column(name="notification_read", type="boolean", nullable=false)
     */
    private $notificationRead;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="notification_read_time", type="datetime", nullable=true)
     */
    private $notificationReadTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="notification_creation_time", type="datetime", nullable=false)
     */
    private $notificationCreationTime;

    /**
     * @var \NotificationType
     *
     * @ORM\ManyToOne(targetEntity="NotificationType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notifications_notification_type", referencedColumnName="idnotification_type")
     * })
     */
    private $notificationsNotificationType;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notifications_user_id", referencedColumnName="id")
     * })
     */
    private $notificationsUser;

    public function getIdnotifications(): ?int
    {
        return $this->idnotifications;
    }

    public function getNotificationsLink(): ?string
    {
        return $this->notificationsLink;
    }

    public function setNotificationsLink(?string $notificationsLink): self
    {
        $this->notificationsLink = $notificationsLink;

        return $this;
    }

    public function isNotificationRead(): ?bool
    {
        return $this->notificationRead;
    }

    public function setNotificationRead(bool $notificationRead): self
    {
        $this->notificationRead = $notificationRead;

        return $this;
    }

    public function getNotificationReadTime(): ?\DateTimeInterface
    {
        return $this->notificationReadTime;
    }

    public function setNotificationReadTime(?\DateTimeInterface $notificationReadTime): self
    {
        $this->notificationReadTime = $notificationReadTime;

        return $this;
    }

    public function getNotificationCreationTime(): ?\DateTimeInterface
    {
        return $this->notificationCreationTime;
    }

    public function setNotificationCreationTime(\DateTimeInterface $notificationCreationTime): self
    {
        $this->notificationCreationTime = $notificationCreationTime;

        return $this;
    }

    public function getNotificationsNotificationType(): ?NotificationType
    {
        return $this->notificationsNotificationType;
    }

    public function setNotificationsNotificationType(?NotificationType $notificationsNotificationType): self
    {
        $this->notificationsNotificationType = $notificationsNotificationType;

        return $this;
    }

    public function getNotificationsUser(): ?UserGGZ
    {
        return $this->notificationsUser;
    }

    public function setNotificationsUser(?UserGGZ $notificationsUser): self
    {
        $this->notificationsUser = $notificationsUser;

        return $this;
    }


}
