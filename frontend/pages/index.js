import Head from "next/head"
import LoginForm from "../components/ui/LoginForm"

export default function Home() {
  return (
    <div>
      <Head>
        <title>Login Page</title>
      </Head>
      <LoginForm />
    </div>
  )
}
