<?php 
    class CustomerForm {
        protected $firstname;
        protected $lastname;
        protected $address;
        protected $city;
        protected $state;
        protected $zip;
        protected $email;
    
        public function display1() {
            ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="tickets">
                <fieldset>
                <legend>Buyer Information</legend>
                <label for="fname">First Name</label>
                <input type="text" name="fname" /><br />
                
                <label for="lname">Last Name</label>
                <input type="text" name="lname" /><br />
                
                <label for="address">Address</label>
                <input type="text" name="address" /><br />
                
                <label for="city">City</label>
                <input type="text" name="city" /><br />
             
                <label for="state">State</label>
                <input type="text" name="state" /><br />
                
                <label for="zip">ZIP</label>
                <input type="text" name="zip" /><br />
                
                <label for="email">Email</label>
                <input type="text" name="email" /><br />
                
            <?php
        }
        
        public function setFirstName($firstname)
        { $this->firstname = $firstname;}
        
        public function getFirstName() 
        { return $this->firstname; }
        
        
        public function setLastName($lastname)
        { $this->lastname = $lastname;}
        
        public function getLastName() 
        { return $this->lastname; }
        
        public function setAddress($address)
        { $this->address= $address;}
        
        public function getAddress() 
        { return $this->address; }
        
        public function setCity($city)
        { $this->city = $city;}
        
        public function getCity() 
        { return $this->city; }
        
        public function setState($state)
        { $this->state = $state;}
        
        public function getState() 
        { return $this->state; }
        
        public function setZip($zip)
        { $this->zip = $zip;}
        
        public function getZip() 
        { return $this->zip; }
        
        public function setEmail($email)
        { $this->email = $email;}
        
        public function getEmail() 
        { return $this->email; }
        
        public function submitFriday($id) {
            $query = "insert into friday" . $id . "(firstName, lastName, address, " . 
                    "city, state, zip, email) values ('" . $firstname . "', '" .
                    $lastname . "', '" . $address . "', '" . $city . "', '" . $state .
                    "', " . $zip . ", '" . $email . "', 'credit card')";
            return $query;
        }
        
        public function submitSunday($id) {
            $query = "insert into sunday" . $id . "(firstName, lastName, address, " . 
                    "city, state, zip, email, payment) values ('" . $firstname . "', '" .
                    $lastname . "', '" . $address . "', '" . $city . "', '" . $state .
                    "', " . $zip . ", '" . $email . "', 'credit card')";
            return $query;
        }
        
        public function getIdFri($concertId) {
            $query = "select * from friday" . $concertId . " where firstName = " .
                    $this->firstName . " AND lastName = " . $this->lastName . " AND " .
                    "address = " . $this->address;
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $orderId = $row['id'];
            return $orderId;
        }
        
        public function getIdSun($concertId) {
            $query = "select * from sunday" . $concertId . " where firstName = " .
                    $this->firstName . " AND lastName = " . $this->lastName . " AND " .
                    "address = " . $this->address;
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $orderId = $row['id'];
            return $orderId;
        }
    }
?>