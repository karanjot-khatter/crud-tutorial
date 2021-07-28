<?php

    Class Model
    {
        private $host = '127.0.0.1';
        private $user = 'root';
        private $pwd = 'root';
        private $dbn = 'oop_crud';
        private $conn;

        public function __construct()
        {
            try {
                $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbn);
            } catch (Exception $e) {
                echo 'connection failed' . $e->getMessage();
            }
        }

        public function insert()
        {
            if (isset($_POST['submit'])) {
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['address'])) {
                    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['address'])) {
                        $name = $_POST['name'];
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];

                        $query = "INSERT INTO records (name, email, mobile, address) VALUES ('$name' , '$email' , '$mobile' , '$address');";
                        if ($sql = $this->conn->query($query)) {
                            echo "<script>alert('records added successfully')</script>";
                            echo "<script>window.location.href = 'index.php'</script>";
                        } else {
                            echo "<script>alert('failed')</script>";
                            echo "<script>window.location.href = 'index.php'</script>";
                        }


                    } else {
                        echo "<script>alert('empty'); </script>";
                        echo "<script>window.location.href = 'index.php'</script>";
                    }
                }
            }
        }

        public function fetch()
        {
            $data = null;

            $query = 'SELECT * FROM records';

            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }

            return $data;
        }

        public function delete($id)
        {
            $query = "DELETE FROM records where id = '$id'";
            if ($sql = $this->conn->query($query)) {
                return true;
            } else {
                return false;
            }
        }

        public function fetch_single($id)
        {

            $data = null;
            $query = "SELECT * FROM records where id = '$id'";
            if ($sql = $this->conn->query($query)) {
                while ($row = $sql->fetch_assoc()) {
                    $data = $row;
                }

                return $data;
            }
        }

        public function edit($id)
        {
            $data = null;
            $query = "SELECT * FROM records where id = '$id'";
            if ($sql = $this->conn->query($query)) {
                while ($row = $sql->fetch_assoc()) {
                    $data = $row;
                }
            }

            return $data;
        }

        public function update()
        {
            if (isset($_POST['update'])) {
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['address'])) {
                    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['address'])) {
                        $name = $_POST['name'];
                        $mobile = $_POST['mobile'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $id = $_REQUEST['id'];

                        $query = "UPDATE records SET name = '$name', email = '$email', mobile = '$mobile', address = '$address' WHERE id = $id";
                        if ($sql = $this->conn->query($query)) {
                            echo "<script>alert('records updated successfully')</script>";
                            echo "<script>window.location.href = 'records.php'</script>";
                        } else {
                            echo "<script>alert('records not updated successfully')</script>";
                            echo "<script>window.location.href = 'records.php'</script>";
                        }
                    }
                }
            }


        }
    }