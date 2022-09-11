import React from "react";
import User from "./User/User.jsx";
import AuthContext from "../../context/auth-context.jsx";

const persons = (props) => props.user.map((user, index) => {
        return <User key={user.id} name={user.name} age={user.age} click={() => { if (window.confirm('Are you sure you wish to delete this user?')) props.clicked(index) } } change={(event) => props.changed(event, user.id)} />;
      })

export default persons;