import React from "react";

const cockpit = (props) => {
    let classDynamic = [];
    let userData = [];
    if(props.user.length <= 2) {
    classDynamic.push('red');
    }
    if(props.user.length <= 1) {
    classDynamic.push('bold');
    }
    const styleButtonCss = {
        backgroundColor: 'yellow',
        padding: '10px 30px',
        border: '1px solid yellow',
        cursor: 'pointer',
        ':hover': {
          backgroundColor: 'lightgreen',
          color: 'black'
        }
      }
    return (
        <div>
            <h1 className={classDynamic.join(' ')}>Hello React!!!</h1>
            <button style={styleButtonCss} onClick={props.toggle}>{props.showUser ? 'Hide User' : 'Show User'}</button>
        </div>
    );
}

export default React.memo(cockpit);