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

use DineroSDK\Exception\DineroException;

class InvoiceCompressed
{
    /**
     * Guid from Dinero
     * @var string
     */
    protected $Guid;

    /**
     * @var string
     */
    public $Date;

    /**
     * @var string
     */
    public $Status;

    /**
     * @var float
     */
    public $TotalInclVat;

    /**
     * @var string
     */
    public $Description;

    /**
     * @var string
     */
    public $ContactName;

    /**
     * @var integer
     */
    public $Number;

    /**
     * @var string
     */
    public $Currency;

    /**
     * @var string
     */
    public $PaymentDate;

    /**
     * @var float
     */
    public $TotalExclVat;

    /**
     * @var float
     */
    public $TotalInclVatInDkk;

    /**
     * @var float
     */
    public $TotalExclVatInDkk;

    /**
     * @var string
     */
    public $MailOutStatus;

    /**
     * @var string
     */
    public $CreatedAt;

    /**
     * @var string
     */
    public $UpdatedAt;

    /**
     * @var string|null
     */
    public $DeletedAt;

    /**
     * @param string $guid
     * @return InvoiceCompressed
     */
    public function withGuid(string $guid) : InvoiceCompressed
    {
        $invoice = clone $this;
        $invoice->Guid = $guid;

        return $invoice;
    }

    /**
     * @return string
     */
    public function getGuid()
    {
        return $this->Guid;
    }

    /**
     * @param string $guid
     */
    public function setGuid($guid)
    {
        throw new DineroException('You can\' set Guid after entity creation. Use \'$invoice->withGuid($guid)\' to get a clone with the GUID set.');
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param string $Date
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return float
     */
    public function getTotalInclVat()
    {
        return $this->TotalInclVat;
    }

    /**
     * @param float $TotalInclVat
     */
    public function setTotalInclVat($TotalInclVat)
    {
        $this->TotalInclVat = $TotalInclVat;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return string
     */
    public function getContactName()
    {
        return $this->ContactName;
    }

    /**
     * @param string $ContactName
     */
    public function setContactName($ContactName)
    {
        $this->ContactName = $ContactName;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param int $Number
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->Currency;
    }

    /**
     * @param string $Currency
     */
    public function setCurrency($Currency)
    {
        $this->Currency = $Currency;
    }

    /**
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->PaymentDate;
    }

    /**
     * @param string $PaymentDate
     */
    public function setPaymentDate($PaymentDate)
    {
        $this->PaymentDate = $PaymentDate;
    }

    /**
     * @return float
     */
    public function getTotalExclVat()
    {
        return $this->TotalExclVat;
    }

    /**
     * @param float $TotalExclVat
     */
    public function setTotalExclVat($TotalExclVat)
    {
        $this->TotalExclVat = $TotalExclVat;
    }

    /**
     * @return float
     */
    public function getTotalInclVatInDkk()
    {
        return $this->TotalInclVatInDkk;
    }

    /**
     * @param float $TotalInclVatInDkk
     */
    public function setTotalInclVatInDkk($TotalInclVatInDkk)
    {
        $this->TotalInclVatInDkk = $TotalInclVatInDkk;
    }

    /**
     * @return float
     */
    public function getTotalExclVatInDkk()
    {
        return $this->TotalExclVatInDkk;
    }

    /**
     * @param float $TotalExclVatInDkk
     */
    public function setTotalExclVatInDkk($TotalExclVatInDkk)
    {
        $this->TotalExclVatInDkk = $TotalExclVatInDkk;
    }

    /**
     * @return string
     */
    public function getMailOutStatus()
    {
        return $this->MailOutStatus;
    }

    /**
     * @param string $MailOutStatus
     */
    public function setMailOutStatus($MailOutStatus)
    {
        $this->MailOutStatus = $MailOutStatus;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->CreatedAt;
    }

    /**
     * @param string $CreatedAt
     */
    public function setCreatedAt($CreatedAt)
    {
        $this->CreatedAt = $CreatedAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->UpdatedAt;
    }

    /**
     * @param string $UpdatedAt
     */
    public function setUpdatedAt($UpdatedAt)
    {
        $this->UpdatedAt = $UpdatedAt;
    }

    /**
     * @return null|string
     */
    public function getDeletedAt()
    {
        return $this->DeletedAt;
    }

    /**
     * @param null|string $DeletedAt
     */
    public function setDeletedAt($DeletedAt)
    {
        $this->DeletedAt = $DeletedAt;
    }
}
