export default function Room({ room }) {
    return (
        <>
            <h1 className="header">{room.name}</h1>
            <hr />
            <h3 className="ml-4 mb-5">
                Today's Schedule: {new Date().toDateString()}
            </h3>
            <div className="flex gap-5 justify-center">
                {room &&
                    room.today_schedules.map((item) => (
                        <div key={item.id} className="shadow movie">
                            <a href={`/rooms/${room.id}/movie/${item.movie.id}`}>
                                <img src={item.movie.poster} className="w-[15rem] h-[15rem]" />
                                <h2 className="p-1">{item.movie.name}</h2>
                                <p className="p-1">
                                    Showtime: <span>{item.showtime}</span>
                                </p>
                            </a>
                        </div>
                    ))}
            </div>
        </>
    );
}
