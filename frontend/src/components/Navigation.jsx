import React, { useEffect, useState } from "react";
import logoDark from "../assets/logo-dark.png";
import LogIn from "./LogIn";
import userIcon from "../assets/user.png";
import { SessionService } from "../services/SessionService";
import { useNavigate } from "react-router-dom";

function Navigation() {
    const [logged, setLogged] = useState(false);
    const [modal, setModal] = useState(false);
    const navigate = useNavigate();

    const closeModal = () => {
        setModal(false);
    };

    const handleProfile = () => {
        navigate("/profile");
    };

    useEffect(() => {
        let session = SessionService.getSessionFromStorage();

        if (session) {
            setLogged(true);
        }
    }, []);

    return (
        <div className="h-[60px] flex px-[30px] w-full justify-between items-center bg-lightGreen">
            <div>
                <img
                    src={logoDark}
                    alt="logo"
                    className="w-[100px] h-[50px] self-start"
                />
            </div>
            <div>
                {!logged ? (
                    <div>
                        <button onClick={() => setModal(true)}>Log in</button>{" "}
                        <button>Guest</button>
                    </div>
                ) : (
                    <button onClick={handleProfile}>
                        <img
                            src={userIcon}
                            alt="user"
                            className="w-[40px] h-[40px] self-start"
                        />
                    </button>
                )}
            </div>
            {modal && (
                <div className="fixed z-10 w-[100%] h-[100%] flex justify-center items-center top-0 left-0">
                    <div
                        className="absolute z-[-1] bg-[#000] opacity-30 w-[100%] h-[100%] cursor-pointer"
                        onClick={() => setModal(null)}
                    ></div>
                    <LogIn closeM={closeModal} />
                </div>
            )}
        </div>
    );
}

export default Navigation;