<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace DineroSDK\Entity;

class Organization
{
    /**
     * Name of the organization
     *
     * @var string
     */
    public $Name;

    /**
     * Id of the organization
     *
     * @var integer
     */
    public $Id;

    /**
     * Whether the Organization has Dinero Pro access
     *
     * @var boolean
     */
    public $IsPro;

    /**
     * Whether the Organization has a paid Dinero Pro subscription
     *
     * @var boolean
     */
    public $IsPayingPro;

    /**
     * Organization constructor.
     * @param int $Id
     */
    public function __construct($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return bool
     */
    public function isIsPro(): bool
    {
        return $this->IsPro;
    }

    /**
     * @param bool $IsPro
     */
    public function setIsPro(bool $IsPro)
    {
        $this->IsPro = $IsPro;
    }

    /**
     * @return bool
     */
    public function isIsPayingPro(): bool
    {
        return $this->IsPayingPro;
    }

    /**
     * @param bool $IsPayingPro
     */
    public function setIsPayingPro(bool $IsPayingPro)
    {
        $this->IsPayingPro = $IsPayingPro;
    }
}
