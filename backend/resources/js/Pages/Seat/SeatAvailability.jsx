import Seat from "./Seat.jsx";

const SeatAvailability = () => {
    return (
        <div className="row">
            Unoccupied : <Seat seatColor="seat-grey" />
            Occupied : <Seat seatColor="seat-disabled" />
        </div>
    );
};

export default SeatAvailability;
