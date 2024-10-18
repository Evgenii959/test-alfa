<?php
class Contact {
    public $name;
    public $phone;
    public $email;
    public $user_agent;
    public $device;
    public $platform;
    public $visit_time;
    public $ip_address;

    public function __construct($data) {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->user_agent = isset($data['user_agent']) ? $data['user_agent'] : null;
        $this->device = isset($data['device']) ? $data['device'] : null;
        $this->platform = isset($data['platform']) ? $data['platform'] : null;
        $this->visit_time = isset($data['visit_time']) ? $data['visit_time'] : null;
        $this->ip_address = $_SERVER['REMOTE_ADDR'];
    }
}