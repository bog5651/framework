<?php
class ApiPostController extends Controller
{
    public function Index()
    {
    }

    public function login()
    {
        $postRaw = $this->apiPostRaw()->data;
        if (empty($postRaw) || !property_exists($postRaw, 'login') || !property_exists($postRaw, 'password')) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 104,
                    'message' => 'Wrong data set'
                ]
            ]);
            die();
        }
        $session_model = $this->loader->getModel('session');
        $token = $session_model->login($postRaw->login, $postRaw->password);
        if (empty($token)) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 201,
                    'message' => 'Wrong login or password'
                ]
            ]);
            die();
        }
        echo json_encode([
            'success' => 1,
            'data' => [
                'token' => $token
            ]
        ]);
        die();
    }

    public function logout()
    {
        $postRaw = $this->apiPostRaw(false, true);
        $token = $postRaw->token;
        $session_model = $this->loader->getModel('session');
        $user_id = $session_model->authentication($token);
        if ($user_id > 0) {
            $session_model->logout($token);
            echo json_encode([
                'success' => 1
            ]);
            die();
        }
        echo json_encode([
            'success' => 0,
            'error' => [
                'code' => 105,
                'message' => 'Wrong token'
            ]
        ]);
        die();
    }

    public function register()
    {
        $postRaw = $this->apiPostRaw()->data;
        if (empty($postRaw) || !property_exists($postRaw, 'login') || !property_exists($postRaw, 'password') || (!property_exists($postRaw, 'firstname')) || (!property_exists($postRaw, 'secondname'))) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 104,
                    'message' => 'Wrong data set'
                ]
            ]);
            die();
        }
        $user_model = $this->loader->getModel('user');
        $users = $user_model->getUsers();
        for ($i = 0; $i < count($users); $i++)
            if ($users[$i]['login'] == $postRaw->login) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 209,
                    'message' => 'This Login alrady used'
                ]
            ]);
            die();
        }
        $id_user = $user_model->addUser($postRaw->login, $postRaw->password, $postRaw->firstname, $postRaw->secondname);
        if ($id_user != -1) {
            $session_model = $this->loader->getModel('session');
            $token = $session_model->login($postRaw->login, $postRaw->password);
            if (empty($token)) {
                echo json_encode([
                    'success' => 0,
                    'error' => [
                        'code' => 201,
                        'message' => 'Wrong login or password'
                    ]
                ]);
                die();
            }
            echo json_encode([
                'success' => 1,
                'data' => [
                    'token' => $token
                ]
            ]);
            die();
        } else {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 209,
                    'message' => 'Register failed'
                ]
            ]);
            die();
        }
    }

    public function deleteAccount()
    {
        $postRaw = $this->apiPostRaw(true, true);
        $data = $postRaw->data;
        $token = $postRaw->token;
        $session_model = $this->loader->getModel('session');
        $user_id = $session_model->authentication($token);
        if ($user_id > 0) {
            $session_model->logout($token);
            $user_model = $this->loader->getModel('user');
            $user_model->deleteUser($user_id);
            echo json_encode([
                'success' => 1
            ]);
            die();
        }
        if (empty($data) || !property_exists($data, 'login') || !property_exists($data, 'password')) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 104,
                    'message' => 'Wrong data set'
                ]
            ]);
            die();
        }
        $token = null;
        $token = $session_model->login($postRaw->data->login, $postRaw->data->password);
        if (empty($token)) {
            echo json_encode([
                'success' => 0,
                'error' => [
                    'code' => 201,
                    'message' => 'Wrong login or password'
                ]
            ]);
            die();
        }
        $user_id = $session_model->authentication($token);
        if ($user_id > 0) {
            $session_model->logout($token);
            $user_model = $this->loader->getModel('user');
            $user_model->deleteUser($user_id);
            echo json_encode([
                'success' => 1
            ]);
            die();
        }
    }
}
?>