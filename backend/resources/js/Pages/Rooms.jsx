export default function Rooms({ rooms }) {
    return (
        <>
            <div className="text-center px-6">
                <h1 className="header">All rooms in this cinema!</h1>
                <hr />
                <div className="flex justify-center">
                    {rooms &&
                        rooms.map((item) => (
                            <a
                                href={"/rooms/" + item.id}
                                className="room shadow px-6 mx-6 mt-2"
                            >
                                <div key={item.id}>
                                    <h2>{item.name}</h2>
                                </div>
                            </a>
                        ))}
                </div>
            </div>
        </>
    );
}
