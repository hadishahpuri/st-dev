import Seat from "./Seat.jsx";
import SeatAvailability from "./SeatAvailability.jsx";
import "./Styles/Seat.css";

const GenerateRows = (
    rowsNumber,
    seatsNumber,
    selectedSeats,
    setSelectedSeats,
    occupiedSeats,
) => {
    const rows = [];
    for (let i = 1; i <= rowsNumber; i++) {
        rows.push(
            <div className="row">
                {GenerateSeats(
                    i,
                    seatsNumber,
                    selectedSeats,
                    setSelectedSeats,
                    occupiedSeats,
                )}
            </div>,
        );
    }
    return rows;
};

const GenerateSeats = (
    rowNumber,
    seatsNumber,
    selectedSeats,
    setSelectedSeats,
    occupiedSeats,
) => {
    const seats = [];
    for (let i = 1; i <= seatsNumber; i++) {
        seats.push(
            <Seat
                seatno={`${rowNumber}_${i}`}
                key={`${rowNumber}_${i}`}
                selectedSeats={selectedSeats}
                setSelectedSeats={setSelectedSeats}
                occupiedSeats={occupiedSeats}
            />,
        );
    }
    return seats;
};

const SeatMatrix = (props) => {
    return (
        <div className="movie-complex">
            <p>Screen This way!</p>
            <div className="row movie-layout mb-5">
                <div className="movie-column-1">
                    {GenerateRows(
                        props.rowsNumber,
                        props.seatsNumber,
                        props.selectedSeats,
                        props.setSelectedSeats,
                        props.occupiedSeats,
                    )}
                </div>
            </div>
            <SeatAvailability />
        </div>
    );
};

export default SeatMatrix;
