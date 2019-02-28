<?php
namespace USPS;

/**
 * Class OpenDistributeLabel.
 */
class EvsLabel extends USPSBase
{
    /**
     * @var string - the api version used for this type of call
     */
    protected $apiVersion = 'eVS';
    /**
     * @var array - route added so far.
     */
    protected $fields = [];

    /**
     * Perform the API call.
     *
     * @return string
     */
    public function createLabel()
    {
        // Add missing required
        $this->addMissingRequired();

        // Sort them
        // Hack by the only way this will work properly
        // since usps wants the tags to be in
        // a certain order
        ksort($this->fields, SORT_NUMERIC);
//echo '<pre>';print_r($this->fields);die;
        // remove the \d. from the key
        foreach ($this->fields as $key => $value) {
            $newKey = str_replace('.', '', $key);
            $newKey = preg_replace('/\d+\:/', '', $newKey);
            unset($this->fields[$key]);
            $this->fields[$newKey] = $value;
        }

        return $this->doRequest();
    }

    /**
     * Return the USPS confirmation/tracking number if we have one.
     *
     * @return string|bool
     */
    public function getConfirmationNumber()
    {
        $response = $this->getArrayResponse();
        // Check to make sure we have it
        if (isset($response[$this->getResponseApiName()])) {
            if (isset($response[$this->getResponseApiName()]['OpenDistributePriorityNumber'])) {
                return $response[$this->getResponseApiName()]['OpenDistributePriorityNumber'];
            }
        }

        return false;
    }

    /**
     * Return the USPS label as a base64 encoded string.
     *
     * @return string|bool
     */
    public function getLabelContents()
    {
        $response = $this->getArrayResponse();

        // Check to make sure we have it
        if (isset($response[$this->getResponseApiName()])) {
            if (isset($response[$this->getResponseApiName()]['OpenDistributePriorityLabel'])) {
                return $response[$this->getResponseApiName()]['OpenDistributePriorityLabel'];
            }
        }

        return false;
    }

    /**
     * returns array of all fields added.
     *
     * @return array
     */
    public function getPostFields()
    {
        return $this->fields;
    }

    /**
     * Set the from address.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $address2
     * @param string $zip4
     *
     * @return object
     */
    public function setFromAddress(
        $firstName,
        $lastName,
        $company,
        $address1,
        $city,
        $state,
        $zip,
		$fromPhone,
        $address2 = null,
        $zip4 = null
    ) {
        $this->setField(3, 'FromName', trim($firstName.' '.$lastName));
        $this->setField(4, 'FromFirm', $company);
        $this->setField(5, 'FromAddress1', $address1);
        $this->setField(6, 'FromAddress2', $address2);
        $this->setField(7, 'FromCity', $city);
        $this->setField(8, 'FromState', $state);
        $this->setField(9, 'FromZip5', $zip);
        $this->setField(10, 'FromZip4', $zip4);
		$this->setField(11, 'FromPhone', $fromPhone);

        return $this;
    }

    /**
     * Set the to address.
     *
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $address2
     * @param string $zip4
     *
     * @return object
     */
    public function setToAddress(
	$firstName,
	$lastName,
	$company,
	$address1,
	$city,
	$state,
	$zip,
	$toPhone,
	$address2 = null,
	$zip4 = null)
    {
        $this->setField(14, 'ToName', $firstName.' '.$lastName);
        $this->setField(15, 'ToFirm',$company);
        $this->setField(16, 'ToAddress1', $address1);
        $this->setField(17, 'ToAddress2', $address2);
        $this->setField(18, 'ToCity', $city);
        $this->setField(19, 'ToState', $state);
        $this->setField(20, 'ToZip5', $zip);
		$this->setField(21, 'ToZip4', $zip4);
		$this->setField(22, 'ToPhone', $toPhone);

        return $this;
    }

    /**
     * Set package weight in ounces.
     *
     * @param $weight
     *
     * @return $this
     */
    public function setWeightOunces($weight)
    {
        $this->setField(25, 'WeightInOunces', $weight);

        return $this;
    }

    /**
     * Set package weight in ounces.
     *
     * @param $weight
     *
     * @return $this
     */
    public function setWeightPounds($weight)
    {
        $this->setField(37, 'WeightInPounds', $weight);

        return $this;
    }

    /**
     * Set any other requried string make sure you set the correct position as well
     * as the position of the items matters.
     *
     * @param int    $position
     * @param string $key
     * @param string $value
     *
     * @return object
     */
    public function setField($position, $key, $value)
    {
        $this->fields[$position.':'.$key] = $value;

        return $this;
    }

    /**
     * Add missing required elements.
     *
     * @return void
     */
    protected function addMissingRequired()
    {
        $required = [
            '1:Revision'                      => '1',
			'2:ImageParameters'				  =>'',
            '3:FromName'               		  => '',
            '4:FromFirm'                  	  => '',
            '5:FromAddress1'           		  => '',
            '6:FromAddress2'                    => '',
            '7:FromCity'                	 => '',
            '8:FromState'            			=> '',
            '9:FromZip5'               		=> '',
            '10:FromZip4'               => '',
            '11:FromPhone'               => '',
            '14:ToName'                    => '',
            '15:ToFirm'          				=> '',
            '16:ToAddress1' 				  => '',
            '17:ToAddress2'              => '',
            '18:ToCity'              => '',
			'19:ToState'              => '',
			'20:ToZip5'              => '',
			'21:ToZip4'              => '',
			'22:ToPhone'              => '',
			'25:WeightInOunces'      => '',
			'26:ServiceType'      => 'PRIORITY',
			'28:ImageType'			=>'PDF',
        ];

        foreach ($required as $item => $value) {
            $explode = explode(':', $item);
            if (!isset($this->fields[$item])) {
                $this->setField($explode[0], $explode[1], $value);
            }
        }
    }
}

?>