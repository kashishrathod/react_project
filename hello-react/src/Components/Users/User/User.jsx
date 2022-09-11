import React, { useEffect, useRef } from "react";
import './User.css';
import PropTypes from 'prop-types';
import styled from "styled-components";
import Aux from "../../../hoc/Auxiliary.jsx";
import WithClass from "../../../hoc/WithClass.jsx";

// const StyleDiv = styled.div`
//     width: 60%;
//     margin: 20px auto;
//     border: 1px solid #eee;
//     box-shadow: 0 2px 3px #000;
//     padding: 16px;
//     text-align: center;
// `;

const user = (props) => {
    const newRef = useRef(null);
    useEffect(() =>{
        newRef.current.focus();
        return() => {
        }
    }, []);
    return (
        <WithClass classes="user_class">
            <p onDoubleClick={props.click}>Hello!! I'm {props.name} and I am {props.age} Year Old!</p>
            <p>{props.children}</p>
            <input type="text" ref={newRef} onChange={props.change} value={props.name} />
        </WithClass>
        //<div className="user_class">
//</div>
    ); 
}

export default user;