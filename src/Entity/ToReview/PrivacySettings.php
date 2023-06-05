<?php

namespace App\Entity\ToReview;

use App\Entity\UserGGZ;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrivacySettings
 *
 * @ORM\Table(name="privacy_settings", indexes={@ORM\Index(name="fk_privacy_settings_user_id_user_idx", columns={"privacy_settings_user_id"})})
 * @ORM\Entity
 */
class PrivacySettings
{
    /**
     * @var int
     *
     * @ORM\Column(name="idprivacy_settings", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprivacySettings;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_lists", type="boolean", nullable=false)
     */
    private $privacySettingsLists;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_transactions", type="boolean", nullable=false)
     */
    private $privacySettingsTransactions;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_activity", type="boolean", nullable=false)
     */
    private $privacySettingsActivity;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_wantlist", type="boolean", nullable=false)
     */
    private $privacySettingsWantlist;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_collection", type="boolean", nullable=false)
     */
    private $privacySettingsCollection;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_location", type="boolean", nullable=false)
     */
    private $privacySettingsLocation;

    /**
     * @var bool
     *
     * @ORM\Column(name="privacy_settings_friend_list", type="boolean", nullable=false)
     */
    private $privacySettingsFriendList;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="privacy_settings_user_id", referencedColumnName="id")
     * })
     */
    private $privacySettingsUser;

    public function getIdprivacySettings(): ?int
    {
        return $this->idprivacySettings;
    }

    public function isPrivacySettingsLists(): ?bool
    {
        return $this->privacySettingsLists;
    }

    public function setPrivacySettingsLists(bool $privacySettingsLists): self
    {
        $this->privacySettingsLists = $privacySettingsLists;

        return $this;
    }

    public function isPrivacySettingsTransactions(): ?bool
    {
        return $this->privacySettingsTransactions;
    }

    public function setPrivacySettingsTransactions(bool $privacySettingsTransactions): self
    {
        $this->privacySettingsTransactions = $privacySettingsTransactions;

        return $this;
    }

    public function isPrivacySettingsActivity(): ?bool
    {
        return $this->privacySettingsActivity;
    }

    public function setPrivacySettingsActivity(bool $privacySettingsActivity): self
    {
        $this->privacySettingsActivity = $privacySettingsActivity;

        return $this;
    }

    public function isPrivacySettingsWantlist(): ?bool
    {
        return $this->privacySettingsWantlist;
    }

    public function setPrivacySettingsWantlist(bool $privacySettingsWantlist): self
    {
        $this->privacySettingsWantlist = $privacySettingsWantlist;

        return $this;
    }

    public function isPrivacySettingsCollection(): ?bool
    {
        return $this->privacySettingsCollection;
    }

    public function setPrivacySettingsCollection(bool $privacySettingsCollection): self
    {
        $this->privacySettingsCollection = $privacySettingsCollection;

        return $this;
    }

    public function isPrivacySettingsLocation(): ?bool
    {
        return $this->privacySettingsLocation;
    }

    public function setPrivacySettingsLocation(bool $privacySettingsLocation): self
    {
        $this->privacySettingsLocation = $privacySettingsLocation;

        return $this;
    }

    public function isPrivacySettingsFriendList(): ?bool
    {
        return $this->privacySettingsFriendList;
    }

    public function setPrivacySettingsFriendList(bool $privacySettingsFriendList): self
    {
        $this->privacySettingsFriendList = $privacySettingsFriendList;

        return $this;
    }

    public function getPrivacySettingsUser(): ?UserGGZ
    {
        return $this->privacySettingsUser;
    }

    public function setPrivacySettingsUser(?UserGGZ $privacySettingsUser): self
    {
        $this->privacySettingsUser = $privacySettingsUser;

        return $this;
    }


}
