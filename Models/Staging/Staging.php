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
     * @var string
     *
     * @ORM\Column(name="staging_config", type="string", nullable=false)
     */
    private $StagingConfig;
}
