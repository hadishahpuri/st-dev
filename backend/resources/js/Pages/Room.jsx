export default function Room({ room }) {
  return (
    <>
      <h1>{room.name}</h1>
      <hr />
      <h3>Today's Schedule</h3>
      <div className="flex gap-5">
        {room && room.today_schedules.map((item) => (
          <div key={item.id}>
            <a href={`/rooms/${room.id}/movie/${item.movie.id}`}>
              <img src={item.movie.poster} className="w-[12rem]" />
              <h2>{item.movie.name}</h2>
              <p>
                Showtime: <span>{item.showtime}</span>
              </p>
            </a>
          </div>
        ))}
      </div>
    </>
  );
}
