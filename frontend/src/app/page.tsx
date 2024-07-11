'use client'
import K from "@/constants";
import { useState, useEffect } from 'react'
import Image from 'next/image'
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import Form from 'react-bootstrap/Form';


export default function Home() {
    const [leaderboard, setLeaderboard] = useState([])
    const [show, setShow] = useState(false);
    const [showForm, setShowForm] = useState(false);
    const [order, setOrder] = useState(false);
    const [sortKey, setSortKey] = useState('points');
    const [selectedUser, setSelectedUser] = useState<User | null>(null)
    const [validated, setValidated] = useState(false);

    const handleClose = () => setShow(false);
    const handleCloseForm = () => setShowForm(false);
    const handleShowForm = () => {
        setValidated(false);
        setShowForm(true);
    };
    const handleShow = (user: User) => {
        setSelectedUser(user)
        setShow(true)
    };

    const handleFormSubmit = async (event: any) => {
        const form = event.currentTarget;
        const validateForm = form.checkValidity();
        setValidated(true);
        event.preventDefault();
        event.stopPropagation();
        if (validateForm) {
            const formData = new FormData(event.currentTarget);
            const formEntries = Object.fromEntries(formData.entries());
            const res = await fetch(
                K.Network.URL.CreateUser,
                {
                    method: K.Network.Method.POST,
                    body: JSON.stringify(formEntries),
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                }
            );
            if (res.status == 200) {
                setShowForm(false)
                loadLeaderBoardData()
            }
        }


    }

    useEffect(() => {
        loadLeaderBoardData();
    }, [])

    const loadLeaderBoardData = async () => {
        try {
            const res = await fetch(
                K.Network.URL.LeaderBoard
            );
            const data = await res.json();
            setLeaderboard(data.data)
        } catch (err) {
            console.log(err);
        }
    }

    const sort = (key: string) => {
        setOrder(!order);
        setSortKey(key)
    };

    const sortedLeaderBoard: User[] = (() => {
        return leaderboard.sort((a: User, b: User) => {
            let x: string | number = '';
            let y: string | number = '';
            switch (sortKey) {
                case 'name':
                    x = a.name.toLowerCase();
                    y = b.name.toLowerCase();
                    break;
                case 'points':
                    x = a.points;
                    y = b.points;
                    break;
                // Add default case to handle unexpected sortKey values
                default:
                    return 0;
            }
            if (order) {
                return x < y ? -1 : x > y ? 1 : 0;
            } else {
                return x > y ? -1 : x < y ? 1 : 0;
            }
        });
    })();

    const getSortIcon = (key: string) => {
        if (key == sortKey) {
            if (order) {
                return <Image className="icon" src="/SortDown.svg" alt="Sort Icon" width={20} height={20} />
            } else {
                return <Image className="icon" src="/SortUp.svg" alt="Sort Icon" width={20} height={20} />
            }
        } else {
            return <Image className="icon" src="/Sort.svg" alt="Sort Icon" width={20} height={20} />
        }
    }

    const increasePoint = async (user: User, operator: string) => {
        if (user.points <= 0 && operator == 'sub') {
            return ;
        }
        const body = {
            user_id: user.id,
            points: 1,
            operator: operator
        }
        const res = await fetch(
            K.Network.URL.AddPoints,
            {
                method: K.Network.Method.POST,
                body: JSON.stringify(body),
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                }
            }
        );
        if (res.status == 200) {
            loadLeaderBoardData()
        }
    }

    const deleteUser = async (user: User) => {
        const body = {
            user_id: user.id
        }
        const res = await fetch(
            K.Network.URL.DeleteUser,
            {
                method: K.Network.Method.POST,
                body: JSON.stringify(body),
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                }
            }
        );
        if (res.status == 200) {
            loadLeaderBoardData()
        }
    }
    return (
        <>
            <div className="container mt-4">
                <div className="row mb-4">
                    <div className="col-md-6 offset-md-3">
                        <Button variant="outline-dark" className="float-end" onClick={handleShowForm}>
                            + Add User
                        </Button>
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-6 offset-md-3">
                        <table className="table table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th onClick={() => sort('name')} role="button">Name{getSortIcon('name')}</th>
                                    <th></th>
                                    <th onClick={() => sort('points')} role="button">Score{getSortIcon('points')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sortedLeaderBoard.map((user: User, index: number) =>
                                    <tr key={'user' + index}>
                                        <td><button type="button" className="btn btn-sm btn-outline-dark mx-1" onClick={() => deleteUser(user)}>x</button></td>
                                        <td><span onClick={() => { handleShow(user) }} role="button">{user?.name}</span></td>
                                        <td className="fixed-width">
                                            <button type="button" className={`btn btn-sm btn-outline-dark mx-1 ${user?.points <= 0 ? 'disabled' : ''}`} onClick={() => increasePoint(user, 'sub')}>-</button>
                                            <button type="button" className="btn btn-sm btn-outline-dark mx-1" onClick={() => increasePoint(user, 'add')}>+</button>
                                        </td>
                                        <td>{user?.points} points</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <Modal show={show} onHide={handleClose} size="lg">
                <Modal.Header closeButton>
                    <Modal.Title>User Details</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div className="row mb-3">
                        <div className="col-md-3">Name</div>
                        <div className="col-md-9">{selectedUser?.name}</div>
                    </div>
                    <div className="row mb-3">
                        <div className="col-md-3">Age</div>
                        <div className="col-md-9">{selectedUser?.age} years</div>
                    </div>
                    <div className="row mb-3">
                        <div className="col-md-3">Points</div>
                        <div className="col-md-9">{selectedUser?.points} points</div>
                    </div>
                    <div className="row mb-3">
                        <div className="col-md-3">Address</div>
                        <div className="col-md-9">{selectedUser?.address}</div>
                    </div>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="outline-dark" onClick={handleClose}>
                        Close
                    </Button>
                </Modal.Footer>
            </Modal>

            <Modal show={showForm} onHide={handleCloseForm} size="lg">
                <Form noValidate validated={validated} onSubmit={handleFormSubmit}>
                    <Modal.Header closeButton>
                        <Modal.Title>Add User</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <Form.Group className="mb-3" controlId="formBasicName">
                            <Form.Label>Name *</Form.Label>
                            <Form.Control name="name" type="text" placeholder="Enter name" required />
                            <Form.Control.Feedback type="invalid">
                                Please enter name.
                            </Form.Control.Feedback>
                        </Form.Group>
                        <Form.Group className="mb-3" controlId="formBasicAge">
                            <Form.Label>Age *</Form.Label>
                            <Form.Control name="age" type="number" placeholder="Enter age" required />
                            <Form.Control.Feedback type="invalid">
                                Please enter age.
                            </Form.Control.Feedback>
                        </Form.Group>

                        <Form.Group className="mb-3" controlId="formBasicAdress">
                            <Form.Label>Adress *</Form.Label>
                            <Form.Control name="address" as="textarea" rows={3} type="text" placeholder="Enter address" required />
                            <Form.Control.Feedback type="invalid">
                                Please enter address.
                            </Form.Control.Feedback>
                        </Form.Group>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="outline-dark" onClick={handleCloseForm}>
                            Close
                        </Button>
                        <Button variant="dark" type="submit">
                            Submit
                        </Button>
                    </Modal.Footer>
                </Form>
            </Modal >
        </>
    );
}
