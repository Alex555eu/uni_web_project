


<link rel="stylesheet" type="text/css" href="public/css/user.css">

<div class="user-container">
    <?php
    // Assuming $user_data is an array of user objects
    if(isset($user_data)) {
        $html = '<div class="user_wrapper">';
        $html .= '<form action="updateUserData" method="post">'; // Replace 'updateUserData' with your actual form handling endpoint
        $html .= '<div class="user_data">';
        $html .= '<input type="text" name="name" value="' . $user_data['name'] . '">';
        $html .= '<output>name</output>';
        $html .= '<input type="text" name="surname" value="' . $user_data['surname'] . '">';
        $html .= '<output>surname</output>';
        $html .= '<input type="text" name="email" value="' . $user_data['email'] . '">';
        $html .= '<output>email</output>';
        $html .= '<button type="submit">Save Changes</button>';
        $html .= '<a href=/logout>Logout</a>';
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';

        echo $html;
    }
    ?>

</div>