<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace EmzStagingEnvironmentDeluxe\Models\Staging;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * Staging Model
 *
 * @ORM\Entity()
 * @ORM\Table(name="emz_staging_environments")
 */
class Staging extends ModelEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="directory", type="string", nullable=false)
     */
    private $directory;

    /**
     * @var @var \DateTime
     *
     * @ORM\Column(name="created_on", type="date", nullable=false)
     */
    private $createdOn;

    /**
     * @var string
     *
     * @ORM\Column(name="db_host", type="string", nullable=false)
     */
    private $dbHost;

    /**
     * @var string
     *
     * @ORM\Column(name="db_port", type="string", nullable=false)
     */
    private $dbPort;

    /**
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", nullable=false)
     */
    private $dbName;

    /**
     * @var string
     *
     * @ORM\Column(name="db_user", type="string", nullable=false)
     */
    private $dbUser;

    /**
     * @var string
     *
     * @ORM\Column(name="db_password", type="string", nullable=false)
     */
    private $dbPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="excluded_folders", type="string", nullable=false)
     */
    private $excludedFolders;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display_errors", type="boolean", nullable=true)
     */
    private $displayErrors;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disable_csrf_token", type="boolean", nullable=true)
     */
    private $disableCsrfToken;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deactivate_compiler_caching", type="boolean", nullable=true)
     */
    private $deactivateCompilerCaching;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activate_maintenance", type="boolean", nullable=true)
     */
    private $activateMaintenance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="move_media_dir", type="boolean", nullable=true)
     */
    private $moveMediaDir;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param mixed $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * @param string $dbHost
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }

    /**
     * @return string
     */
    public function getDbPort()
    {
        return $this->dbPort;
    }

    /**
     * @param string $dbPort
     */
    public function setDbPort($dbPort)
    {
        $this->dbPort = $dbPort;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @param string $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * @param string $dbUser
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * @param string $dbPassword
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }

    /**
     * @return string
     */
    public function getExcludedFolders()
    {
        return $this->excludedFolders;
    }

    /**
     * @param string $excludedFolders
     */
    public function setExcludedFolders($excludedFolders)
    {
        $this->excludedFolders = $excludedFolders;
    }

    /**
     * @return boolean
     */
    public function getDisplayErrors()
    {
        return $this->displayErrors;
    }

    /**
     * @param boolean $displayErrors
     */
    public function setDisplayErrors($displayErrors)
    {
        $this->displayErrors = $displayErrors;
    }

    /**
     * @return boolean
     */
    public function getDisableCsrfToken()
    {
        return $this->disableCsrfToken;
    }

    /**
     * @param boolean $disableCsrfToken
     */
    public function setDisableCsrfToken($disableCsrfToken)
    {
        $this->disableCsrfToken = $disableCsrfToken;
    }

    /**
     * @return boolean
     */
    public function getDeactivateCompilerCaching()
    {
        return $this->deactivateCompilerCaching;
    }

    /**
     * @param boolean $deactivateCompilerCaching
     */
    public function setDeactivateCompilerCaching($deactivateCompilerCaching)
    {
        $this->$deactivateCompilerCaching = $deactivateCompilerCaching;
    }

    /**
     * @return boolean
     */
    public function getActivateMaintenance()
    {
        return $this->activateMaintenance;
    }

    /**
     * @param boolean $activateMaintenance
     */
    public function setActivateMaintenance($activateMaintenance)
    {
        $this->activateMaintenance = $activateMaintenance;
    }

    /**
     * @return boolean
     */
    public function getMoveMediaDir()
    {
        return $this->moveMediaDir;
    }

    /**
     * @param boolean $moveMediaDir
     */
    public function setMoveMediaDir($moveMediaDir)
    {
        $this->moveMediaDir = $moveMediaDir;
    }
}
