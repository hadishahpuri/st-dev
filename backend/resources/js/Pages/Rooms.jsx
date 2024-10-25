export default function Rooms({ rooms }) {
  return (
    <>
      <h1>All rooms in this cinema !!!!!!</h1>
      <hr />
      <div className="flex">
        {rooms && rooms.map((item) => (
          <div key={item.id}>
            <a href={"/rooms/" + item.id}>
              <h2>{item.name}</h2>
            </a>
          </div>
        ))}
      </div>
    </>
  );
}
