const Seat = (props) => {
    const seatNumber = props.seatno;
    const seatStatus = props.seatColor
        ? props.seatColor
        : (props.occupiedSeats.includes(seatNumber)
            ? "seat-disabled"
            : "seat-grey");

    const seatClickHandler = (event, seatNumber) => {
        if (props.occupiedSeats.includes(seatNumber)) {
            return false;
        }
        const seatColor = event.target.classList;
        if (props.selectedSeats.includes(seatNumber)) {
            seatColor.remove("seat-selected");
            seatColor.add("seat-grey");
            props.setSelectedSeats(props.selectedSeats.filter((item) => {
                return item !== seatNumber;
            }));
        } else {
            seatColor.remove("seat-grey");
            seatColor.add("seat-selected");
            props.setSelectedSeats([...props.selectedSeats, seatNumber]);
        }
    };

    return (
        <div className="col-2 col-md-2">
            <div
                key={seatNumber}
                className={`seat ${seatStatus}`}
                onClick={(e) => seatClickHandler(e, seatNumber)}
            />
        </div>
    );
};

export default Seat;
