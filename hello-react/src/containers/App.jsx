import React, { useEffect, useState } from 'react';
import './App.css';
import User from '../Components/Users/User/User.jsx';
import Users from '../Components/Users/Users.jsx';
import Cockpit from '../Components/Cockpit/Cockpit.jsx';
import AuthContext from '../context/auth-context.jsx';

const app = () =>  {
  const [showMyUser, setShowUser] = useState(false);

  var userArray = [
    {id: 1, name: "user 1", age: 22},
    {id: 2, name: "user 2", age:23},
    {id: 3, name: "user 3", age:19},
  ];

  const [userState, updateUserState] = useState(userArray);
  const [authState, updateauthState] = useState(
    {
      authenticated: false
    }
  );

  useEffect(() => {
    console.log('use effect working');
  }, [userState]);

  const switchNameHandler = (newName) => {
    updateUserState({
      user: [
        {name: newName, age: 22},
        {name: "user 222", age:23},
        {id: 3, name: "user 333", age:19},
      ],
       showUser: false
    });
  }

  const onChangeHandler = (event, id) => {
    const userIndex = userState.findIndex(u => {
      return u.id === id;
    });
    const user = { ...userState[userIndex] };
    user.name = event.target.value;
    const users = [ ...userState ];
    users[userIndex] = user;
    updateUserState(users);
  }

  const toggleHandler = () => {
    let flag = showMyUser;
    setShowUser(!flag);
  }

  const deleteHandler = (userIndex) => {
    let userObject = [ ...userState ]; // copy of state not point orginal state
    userObject.splice(userIndex, 1);
    updateUserState(userObject);
  }

  const loginHandler = () => {
    updateauthState({
      authenticated: true
    });
  }
 
  
  return (
    <div className="App">
     <Cockpit user={userState} showUser={showMyUser} toggle={toggleHandler} />
     <AuthContext.Provider value={{authenticated: authState.authenticated, login: loginHandler}}>
      {showMyUser && (
        <div>
          {
            <Users user={userState} clicked={deleteHandler} changed={onChangeHandler}/>
          //   userState.user.map((user, index) => {
          //   return <User key={user.id} name={user.name} age={user.age} click={() => { if (window.confirm('Are you sure you wish to delete this user?')) deleteHandler(index) } } change={(event) => onChangeHandler(event, user.id)} />;
          // })
          }
        </div>)}
     </AuthContext.Provider>
    </div>
  );
}

export default app;