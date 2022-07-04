import Head from "next/head"
import LoginForm from "../components/ui/LoginForm"

export default function Home() {
  return (
    <>
      <Head>
        <title>Login Page</title>
      </Head>
      <LoginForm />
    </>
  )
}
