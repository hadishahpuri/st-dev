import { useState } from "react";
import SeatMatrix from "./Seat/SeatMatrix.jsx";
import axios from "axios";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.min.css";

export default function Movie(
    { movie: movie, schedule: scheule, occupiedSeats: occupiedSeats },
) {
    const [selectedSeats, setSelectedSeats] = useState([]);

    const ReserveSelectedSeats = () => {
        if (selectedSeats.length === 0) {
            return false;
        }
        axios.post("/rooms/reserve", {
            schedule_id: scheule.id,
            selectedSeats: selectedSeats,
        }).then((res) => {
            toast.success("Successfully reserved", {
                position: "bottom-left",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
            });
            return res.data.occupiedSeats;
        }).then((data) => setSelectedSeats(data))
            .catch((err) => {
                toast.error(err.response?.data?.error ?? "Internal server error!", {
                    position: "bottom-left",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    progress: undefined,
                    theme: "light",
                });
            });
    };

    return (
        <>
            <ToastContainer />
            <div className="text-center">
                <img src={movie.poster} className="w-[22rem]" />
                <h1>{movie.name}</h1>
                <h3>
                    Showtime: <span>{scheule.showtime}</span>
                </h3>
            </div>
            <hr />
            <SeatMatrix
                rowsNumber={scheule.room.rows_number}
                seatsNumber={scheule.room.seats_number}
                selectedSeats={selectedSeats}
                setSelectedSeats={setSelectedSeats}
                occupiedSeats={occupiedSeats}
            />

            <div className="text-center">
                <button
                    className="btn rounded bg-gray-200/80 p-4 mt-3"
                    onClick={ReserveSelectedSeats}
                >
                    Reserve {selectedSeats.length} seats
                </button>
            </div>
        </>
    );
}
