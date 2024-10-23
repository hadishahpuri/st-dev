export default function Rooms({ rooms }) {
    return (
        <>
            <h1>All rooms in this cinema</h1>
            <hr />
            {rooms && rooms.map((item) => (
                <div key={item.id}>
                    <h2>{item.title}</h2>
                </div>
            ))}
        </>
    )
}
